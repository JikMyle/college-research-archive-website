<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Document;
use Spatie\PdfToImage\Pdf;
use App\Http\Requests\DocumentRequest;
use Illuminate\Support\Facades\Storage;

class DocumentUpsertController extends Controller
{
    /*
     * Uploads new document into database.
     */
    public function uploadDocument(DocumentRequest $request, Document $document)
    {
        $validated = $request->validated();

        /* 
            Sets form input as document attributes in database
         */
        $document->title = $validated['title'];
        $document->program = strtolower($validated['program']);
        $document->year_submitted = $validated['date_submitted'];
        $document->excerpt = $validated['excerpt'];
        $document->file_name = 'temporary-string';
        $document->save();

        /* 
            Uploads file to server storage
         */
        $directory = 'documents/' . strtolower($validated['program']. '/');
        $file_name = str_replace(' ', '-', $validated['upload_file']->getClientOriginalName());
        $new_file_name = $document->id . '-' . $document->year_submitted . '-' . $file_name;

        Storage::putFileAs($directory, $validated['upload_file'], $new_file_name);
        $this->generateThumbnail(Storage::path($directory . $new_file_name), $document->id);

        $document->file_name = $new_file_name;
        $document->save();

        /* 
            Creates new author in the database and attaches it to document
         */
        foreach ($validated['authors'] as $author) {
            $author = Author::updateOrCreate(
                [
                    'first_name' => ucwords($author['first_name']),
                    'last_name' => ucwords($author['last_name'])
                ]
            );

            if(!$document->authors->where('id', $author->id)->first()) {
                $document->authors()->attach($author->id);
            }
        }

        return redirect('admin/documents')->with('success', 'New document successfully added.');
    }

    /**
     * Updates a document attributes in the database except authors
     */
    public function updateDocument(DocumentRequest $request, Document $document)
    {
        $updated = ['updated' => 'info'];
        $message = ['error' => 'Could not update document information.'];

        $validated = $request->validated();

        $document->title = $validated['title'];
        $document->year_submitted = $validated['date_submitted'];
        $document->excerpt = $validated['excerpt'];

        /* 
            If program was changed, files are moved to the corresponding directory
            */
        if($document->program !== $validated['program']) {
            $old_directory = 'documents/' . strtolower($document->program) . '/' . $document->file_name;
            $new_directory = 'documents/' . strtolower($validated['program']) . '/' . $document->file_name;

            Storage::move($old_directory, $new_directory);

            $document->program = strtolower($validated['program']);
        }

        /* 
            If file was changed, old files are removed, and a new thumbnail is generated
            */
        if(isset($validated['upload_file'])) {
            $directory = 'documents/' . strtolower($validated['program'] . '/');
            $file_name = str_replace(' ', '-', $validated['upload_file']->getClientOriginalName());
            $new_file_name = $document->id . '-' . $document->date_submitted . '-' . $file_name;

            Storage::delete($directory . '/' . $document->file_name);

            $document->file_name = $new_file_name;
            Storage::putFileAs($directory, $validated['upload_file'], $new_file_name);

            $this->generateThumbnail(Storage::path($directory . $new_file_name), $document->id);
        }

        $message = ['success' => 'Document information successfully updated.'];
        
        $document->save();

        return back()->with($message)->with($updated);
    }

    /**
     * Dettaches author from document in the database
     */
    public function removeAuthor(DocumentRequest $request, Document $document) {
        $updated['updated'] = 'author';

        $author = Author::find($request->author_id);
        $authorName = $author->first_name . ' ' . $author->last_name;

        if($document->authors()->count() == 1) return back()
            ->withErrors(['Document must have at least 1 author!'])
            ->with($updated);
        
        $document->authors()->detach($author->id);
        $message['success'] = 'Author ' . $authorName . ' successfully removed from document.';

        return back()->with($message)->with($updated);
    }

    /**
     * Creates and/or attaches an author in the database to document
     */
    public function addAuthor(DocumentRequest $request, Document $document) {
        $updated['updated'] = 'author';
        $message['success'] = 'New author successfully added to document.';

        $author = Author::updateOrCreate([  
            'first_name' => ucwords($request->authors[0]['first_name']),
            'last_name' => ucwords($request->authors[0]['last_name']),
        ]);

        $authorName = $author->first_name . ' ' . $author->last_name;

        if(!$document->authors->where('id', $author->id)->first()) {
            $document->authors()->attach($author);
            return back()->with($message)->with($updated);
        }

        return back()
            ->withErrors(['author' => 'Author ' . $authorName . ' already assigned to document!'])
            ->with($updated);
    }

    /* 
        Generates a thumbnail for the specified pdf document
        Note: Ensure that public directory is linked to storage
     */
    private function generateThumbnail(string $document, string $id) {
        $publicPath = public_path('storage/thumbnails/');
        
        if(!file_exists($publicPath)) { // Creates thumbnail directory if it does not exist
            Storage::disk('public')->makeDirectory('thumbnails');
        }
           
        $pdf = new Pdf($document);
        $pdf->setOutputFormat('jpeg')
            ->setCompressionQuality(100)
            ->saveImage($publicPath . $id .'.jpg');    // Only document ID is used as the name
    }
}

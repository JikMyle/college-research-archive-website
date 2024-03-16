<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Document;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function showUserRegisterForm() {
        return view('admin.user-registration');
    }

    public function showDocumentCreateForm() {
        return view('document.new-document');
    }

    public function showDocumentEditForm(Document $document) {
        return view('document.edit-document', ['document' => $document]);
    }

    /**
     * Registers a new user to database
     */
    public function registerUser(UserRequest $request){
        $validated = $request->validated();

        $user = new User;
        $user->username = $validated['username'];
        $user->password = $validated['password'];
        // $user->email = $validated['email'];
        $user->is_admin = false;
        // $user->is_admin = $validated['access_level'];
        $user->first_name = ucwords($validated['first_name']);
        $user->last_name = ucwords($validated['last_name']);
        $user->save();

        // event(new Registered($user));   // Sends verification email to new user's email

        return redirect('admin/users')->with('success', 'User successfully registered.');
    }

    /**
     * Deletes users from the database
     */
    public function deleteUser(Request $request) {
        $message = ['error' => 'Please select a user.'];

        if(!isset($request->userIds)) return back()->withErrors([$message]);

        $activeUser = $request->user();
        $count = 0;

        foreach ($request->userIds as $userId) {
            $message = $this->deleteUserById($userId, $activeUser->id);
            if(key($message) == 'success') $count++;
        }
        
        if(key($message) == 'error') return back()->withErrors([$message]);

        $message['success'] = $count . ' ' . $message['success'];
        return back()->with($message);
    }

    /**
     * Deletes a user from the database using the ID
     */
    private function deleteUserById(int $id, int $activeId) {
        if($activeId === $id) {
            return ['error' => 'Warning: Cannot delete own account!'];    // Prevents user from deleting own account
        }

        $user = User::withTrashed()->find($id);

        if($user->is_admin) {
            return ['error' => 'Warning: Cannot delete an admin!'];
        }

        if($user->deleted_at) {
            $user->forceDelete();   // Permanently deletes user if they were soft-deleted previously
            return ['success' => 'User account/s have been permanently deleted.'];
        } 
        else {
            $user->delete();    // Soft-deletes user. Will not be seen by queries, but can be restored
            return ['success' => 'User account/s successfully deleted'];
        }
    }

    /**
     * Restores soft-deleted users from the database
     */
    public function restoreUser(Request $request) {
        $message = ['error' => 'Please select a user.'];

        if(!isset($request->userIds)) return back()->withErrors([$message]);

        $count = 0;

        foreach ($request->userIds as $userId) {
            $message = $this->restoreUserById($userId);
            if(key($message) == 'success') $count++;
        }

        if(key($message) == 'error') return back()->withErrors([$message]);

        $message['success'] = $count . ' ' . $message['success'];
        return back()->with($message);
    }

    /**
     * Restores a soft-deleted user from the database using the ID
     */
    private function restoreUserById(int $id) {
        $user = User::withTrashed()->find($id);

        if($user) {
            $user->restore();
            return ['success' => 'User account/s successfully restored.'];
        }

        return ['error' => 'Could not restore user.'];
    }

    /**
     * Changes the access level of a user in the database
     */
    // public function updateAccess(Request $request) {
    //     $message = ['error' => 'Warning: Cannot change own account\'s access level'];

    //     $user = User::find($request->userIds[0]);

    //     if($user && $request->user()->id == $user->id) {
    //         return back()->withErrors([$message]);
    //     }

    //     if($request->level == 1) {
    //         $user->is_admin = true;
    //         $user->save();
    //         $message = ['success' => 'User ' . $user->username . ' successfully set to Administrator'];
    //     }
    //     else {
    //         $user->is_admin = false;
    //         $user->save();
    //         $message = ['success' => 'User ' . $user->username . ' successfully set to Student'];
    //     }

    //     return back()->with($message);
    // }

    /**
     * Deletes documents from the database
     */
    public function deleteDocument(Request $request) {
        $message = ['error' => 'Please select a document.'];

        if(!isset($request->documentIds)) return back()->withErrors([$message]);

        $count = 0;

        foreach ($request->documentIds as $documentId) {
            $message = $this->deleteDocumentById($documentId);
            if(key($message) == 'success') $count++;
        }
        
        if(key($message) == 'error') return back()->withErrors([$message]);

        $message['success'] = $count . ' ' . $message['success'];
        return back()->with($message);
    }

    /**
     * Deletes document from the database using the ID
     */
    private function deleteDocumentById(int $id) {
        $document = Document::withTrashed()->find($id);

        if($document->deleted_at) {     // Permanently deletes document and associated files if it was soft-deleted previously
            Storage::delete('documents/' . strtolower($document->program) . '/' . $document->file_name);
            Storage::delete('public/thumbnails/' . $document->id . '.jpg');
            $document->forceDelete();
            return ['success' => 'Document/s have been permanently deleted.'];
        }
        else {
            $document->delete();      // Soft-deletes document. Will not be seen by queries, but can be restored
            return ['success' => 'Document/s successfully sent to trash.'];
        }
    }

    /**
     * Restores soft-deleted documents in the database 
     */
    public function restoreDocument(Request $request) {
        $message = ['error' => 'Please select an entry.'];
        if(!isset($request->documentIds)) return back()->with($message);

        $count = 0;

        foreach ($request->documentIds as $documentId) {
            $message = $this->restoreDocumentById($documentId);
            if(key($message) == 'success') $count++;
        }

        if(key($message) == 'error') return back()->withErrors([$message]);

        $message['success'] = $count . ' ' . $message['success'];
        return back()->with($message);
    }

    /**
     * Restores soft-deleted documents in the database using the ID
     */
    private function restoreDocumentById(int $id) {
        $document = Document::onlyTrashed()->find($id);
        if($document) {
            $document->restore();
            return ['success' => 'Document/s successfully restored.'];
        }

        return ['error' => 'Could not restore entry.'];
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Document;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function showUsers(Request $request) {
        $users = $this->filterUsers($request);
        
        return view('admin.user-database', ['results' => $users, 'request' => $request]);
    }

    public function showDocuments(Request $request) {
        $documents = $this->filterDocuments($request);

        if($request->routeIs('admin.documents')) {  // Checks if the user was searching in the admin page
            return view('admin.document-database', ['results' => $documents, 'request' => $request]);
        }
        else {  // Else returns to the regular search page
            return view('document.library', ['results' => $documents, 'request' => $request]);
        }
    }

    private function filterUsers(Request $request) {
        $itemsPerPage = (!$request->itemsPerPage) ? 10 : $request->itemsPerPage;

        $users = User::ShowTrashed($request->showTrash)
            ->hasKeyword($request->keywords)
            ->byAccessLevel($request->accessLevel)
            ->byDate($request->dateFrom, $request->dateTo)
            ->sortBy($request->sortBy)
            ->paginate($itemsPerPage);
        
        return $users;
    }

    private function filterDocuments(Request $request) {
        $itemsPerPage = (!$request->itemsPerPage) ? 10 : $request->itemsPerPage;

        $documents = Document::showTrashed($request->showTrash)
            ->hasKeyword($request->keywords)
            ->byProgram($request->program)
            ->byDate($request->dateTo, $request->dateFrom)
            ->sortBy($request->sortBy)
            ->paginate($itemsPerPage);

        return $documents;
    }
}

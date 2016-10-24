<?php

namespace TobyMaxham\Logger;

use Illuminate\Routing\Controller;

/**
 * Class LogViewerController
 * @package TobyMaxham\Logger
 * @author Tobias Maxham <git2016@maxham.de>
 */
class LogViewerController extends Controller
{
    /**
     * @return \Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function index()
    {
        if (\Input::get('l')) {
            LaravelLogViewer::setFile(base64_decode(\Input::get('l')));
        }

        if (\Input::get('dl'))
            return \Response::download(base64_decode(\Input::get('dl')));

        if (\Input::has('del')) {
            \File::delete(base64_decode(\Input::get('del')));
            return \Redirect::to(\Request::url());
        }

        return view('maxham-log-viewer::log', [
            'logs' => LaravelLogViewer::all(),
            'files' => LaravelLogViewer::getFiles(true),
            'current_file' => LaravelLogViewer::getFileName()
        ]);
    }
}
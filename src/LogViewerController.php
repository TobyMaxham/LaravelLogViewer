<?php

namespace TobyMaxham\Logger;

use Illuminate\Routing\Controller;

/**
 * @author Tobias Maxham <git2020@maxham.de>
 */
class LogViewerController extends Controller
{

    /**
     * @var LaravelLogViewer
     */
    private $log_viewer;

    /**
     * LogViewerController constructor.
     */
    public function __construct()
    {
        $this->log_viewer = new LaravelLogViewer();
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function index()
    {
        if (request()->get('l')) {
            LaravelLogViewer::setFile(base64_decode(request()->get('l')));
        }

        if (request()->get('dl'))
            return \Response::download(base64_decode(\Input::get('dl')));

        if (request()->has('del')) {
            \File::delete(base64_decode(request()->get('del')));
            return \Redirect::to(\Request::url());
        }

        return view('maxham-log-viewer::log', [
            'logs' => $this->log_viewer->all(),
            'files' => $this->log_viewer->getFiles(true),
            'current_file' => $this->log_viewer->getFileName()
        ]);
    }
}
<?php

namespace TobyMaxham\Logger;

if (class_exists("\\Illuminate\\Routing\\Controller")) {
    class BaseController extends \Illuminate\Routing\Controller
    {
    }
} elseif (class_exists("Laravel\\Lumen\\Routing\\Controller")) {
    class BaseController extends \Laravel\Lumen\Routing\Controller
    {
    }
}

/**
 * @author Tobias Maxham <git2020@maxham.de>
 */
class LogViewerController extends BaseController
{

    /**
     * @var LaravelLogViewer
     */
    private $log_viewer;

    /**
     * @var \Illuminate\Contracts\Foundation\Application|\Illuminate\Foundation\Application|mixed
     */
    private $request;

    /**
     * LogViewerController constructor.
     */
    public function __construct()
    {
        $this->log_viewer = new LaravelLogViewer();
        $this->request = app('request');
    }

    public function filenameFor($key)
    {
        return base64_decode($this->request->input($key));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View|\Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function index()
    {
        if (request()->get('l')) {
            if(!file_exists($file = $this->filenameFor('l'))) {
                return redirect($this->request->url());
            }

            $this->log_viewer->setFile($file);
        }

        if (request()->get('dl')) {
            if(!file_exists($file = $this->filenameFor('dl'))) {
                return response('');
            }

            return response()->download($file);
        }

        if (request()->has('del')) {
            app('files')->delete($this->filenameFor('del'));

            return redirect($this->request->url());
        }

        return view('maxham-log-viewer::log', [
            'logs' => $this->log_viewer->all(),
            'files' => $this->log_viewer->getFiles(true),
            'current_file' => $this->log_viewer->getFileName(),
        ]);
    }
}

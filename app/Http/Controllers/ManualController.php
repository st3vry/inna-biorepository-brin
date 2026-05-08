<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ManualController extends Controller
{
    /**
     * Show a manual (markdown) page parsed to HTML.
     *
     * @param  string  $name
     */
    public function show(Request $request, $name)
    {
        $name = basename($name); // prevent traversal
        $path = resource_path("manuals/{$name}.md");

        if (! File::exists($path)) {
            abort(404);
        }

        $markdown = File::get($path);

        // Prefer league/commonmark if installed, fallback to Parsedown if present,
        // otherwise show raw markdown inside <pre>
        if (class_exists('\\League\\CommonMark\\CommonMarkConverter')) {
            $converter = new \League\CommonMark\CommonMarkConverter();
            $html = $converter->convertToHtml($markdown);
        } elseif (class_exists('\\Parsedown')) {
            $parsedown = new \Parsedown();
            $html = $parsedown->text($markdown);
        } else {
            $html = '<pre>' . e($markdown) . '</pre>';
        }

        return view('manuals.show', [
            'title' => ucfirst(str_replace(['-', '_'], ' ', $name)),
            'content' => $html,
        ]);
    }

    public function default(Request $request, $name = 'index')
    {
        $name = "User Manual"; // prevent traversal
        $path = resource_path("manuals/user_manual.md");

        if (! File::exists($path)) {
            abort(404);
        }

        $markdown = File::get($path);

        // Prefer league/commonmark if installed, fallback to Parsedown if present,
        // otherwise show raw markdown inside <pre>
        if (class_exists('\\League\\CommonMark\\CommonMarkConverter')) {
            $converter = new \League\CommonMark\CommonMarkConverter();
            $html = $converter->convertToHtml($markdown);
        } elseif (class_exists('\\Parsedown')) {
            $parsedown = new \Parsedown();
            $html = $parsedown->text($markdown);
        } else {
            $html = '<pre>' . e($markdown) . '</pre>';
        }

        return view('manuals.show', [
            'title' => ucfirst(str_replace(['-', '_'], ' ', $name)),
            'content' => $html,
        ]);
    }
}

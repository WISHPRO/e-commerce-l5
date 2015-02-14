<?php

// handling backend related errors
//App::error(function ($exception, $code) {
//    $referrer = Request::server('HTTP_REFERER');
//
//    if (str_contains($referrer, 'backend')) {
//        Log::error($exception);
//        return Response::view('backend.errors.error', array(), $code);
//    }
//
//});

//App::error(function (Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
//
//    // Log the error
//    Log::error($exception);
//
//    // Redirect to error route with any message
//    return Response::view('frontend.errors.error', array('message' => 'Page not found', 'code' => '404'), 404);
//});

//App::error(function ($exception, $code) {
//    Log::error($exception);
//    if (Config::getEnvironment() === 'debug')
//    switch ($code) {
//        case 401: {
//            if (str_contains(Request::server('HTTP_REFERER'), 'backend')) {
//
//                return Response::view('backend.errors.error', array('message' => 'UNAUTHORIZED', 'code' => '401'), 401);
//            }
//
//            else {
//
//                return Response::view('frontend.errors.error', array('code' => '401', 'message' => 'You are unauthorized from performing this action'), 401);
//            }
//        }
//            break;
//        case 403: {
//            if (str_contains(Request::server('HTTP_REFERER'), 'backend')) {
//
//                return Response::view('backend.errors.error', array('code' => '403', 'message' => 'FORBIDDEN'), 403);
//            }
//            else {
//
//                return Response::view('frontend.errors.error', array('code' => '403', 'message' => 'You are forbidden from performing this action'), 403);
//            }
//        }
//            break;
//        case 404: {
//            if (str_contains(Request::server('HTTP_REFERER'), 'backend')) {
//
//                return Response::view('backend.errors.error', array('code' => '404', 'message' => 'Page not found'), 404);
//            }
//            else {
//
//                return Response::view('frontend.errors.error', array('code' => '404', 'message' => 'Page not found'), 404);
//            }
//        }
//            break;
//        case 500: {
//            if (str_contains(Request::server('HTTP_REFERER'), 'backend')) {
//
//                return Response::view('backend.errors.error', array('code' => '500', 'message' => 'UNKNOWN SERVER ERROR'), 500);
//            }
//            else {
//
//                return Response::view('frontend.errors.error', array('code' => '500', 'message' => 'The server encountered an Error'), 500);
//            }
//        }
//            break;
//
//        default:
//            return Response::view('frontend.errors.error', array('code' => $code, 'message' => 'An unknown error has occured'), $code);
//    }
//});
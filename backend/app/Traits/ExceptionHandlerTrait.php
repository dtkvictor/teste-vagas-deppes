<?php
namespace App\Traits;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use Illuminate\Http\Response;

trait ExceptionHandlerTrait
{
    public function handleException($exception)
    {            
        if ($exception instanceof QueryException) {
            Log::error("Failed to execute database query.\nError: {error},\nQuery: {query},\nBindings: {bindings}", [
                'error' => $exception->getMessage(),
                'query' => $exception->getSql(),
                'bindings' => $exception->getBindings()
            ]);
            return response()->json([
                'error' => 'failed.execute_database_query.',                
            ], Response::HTTP_INTERNAL_SERVER_ERROR);

        } else {
            Log::error("Unexpected error during {operation}. Error: {error}", [
                'error' => $exception->getMessage()
            ]);
            return response()->json([
                'error' => 'failed.unexpected_error.',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}

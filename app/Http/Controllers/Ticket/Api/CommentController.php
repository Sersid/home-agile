<?php

namespace App\Http\Controllers\Ticket\Api;

use App\Http\Requests\Ticket\Comment\AddRequest;
use App\Models\Ticket\Comment;
use App\Repositories\Ticket\CommentRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Class CommentController
 * @package App\Http\Controllers\Ticket\Api
 */
class CommentController extends BaseController
{
    /**
     * Комментарии для тикета
     *
     * @param int               $id
     * @param CommentRepository $repository
     *
     * @return Builder[]|Collection
     */
    public function index($id, CommentRepository $repository)
    {
        return $repository->getForTicket($id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AddRequest $request
     * @param Comment    $comment
     *
     * @return Comment|Model
     */
    public function store(AddRequest $request, Comment $comment)
    {
        return $comment->add($request->get('ticket_id'), $request->get('text'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int     $id
     *
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}

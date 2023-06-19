<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GamesBoard;
use Illuminate\Http\Request;

class GamesBoardsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.games_boards.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.games_boards.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required',
        ],[
            'name.required'         => 'El campo nombre es obligatorio',
        ]);

        $game = new GamesBoard([
            'name'          => $request->get('name'),
            'description'   => $request->get('description')
        ]);
        $game->save();

        return redirect()->route('admin.game-boards.index')->with('info', 'Se creó la tarjeta de juego correctamente');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $game_board = GamesBoard::find($id);

        return view('admin.games_boards.edit', compact('game_board'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $request->validate([
            'name'          => 'required',
        ],[
            'name.required'         => 'El campo nombre es obligatorio',
        ]);

        $game = GamesBoard::find($id);

        $game->update([
            'name'          => $request->get('name'),
            'description'   => $request->get('description'),
        ]);
        
        return redirect()->route('admin.game-boards.index')->with('info', 'Se actualizó la tarjeta de juego correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CarrinhoController extends Controller
{
    public function carrinhoLista() {
        $itens = \Cart::getContent();
        return view('site.carrinho', compact('itens'));
    }

    public function adicionarCarrinho(Request $request) {
        \Cart::add([
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => abs($request->qnt),
            'attributes' => array(
                'image' => $request->img
            )
        ]);

        return redirect()->route('site.carrinho')->with('sucesso','Produto adicionado no carrinho com sucesso!');
    }

    public function removeCarrinho(Request $request) {

        \Cart::remove($request->id);

        return redirect()->route('site.carrinho')->with('sucesso','Produto removido do carrinho com sucesso!');
    }

    public function atualizaCarrinho(Request $request) {
        \Cart::update($request->id, [
            'quantity' => [
                'relative' => false,
                'value' => abs($request->quantity)
            ]

        ]);

        return redirect()->route('site.carrinho')->with('sucesso','Produto do carrinho atualizado com sucesso!');
    }

    public function limparCarrinho() {
        \Cart::clear();
        
        return redirect()->route('site.carrinho')->with('aviso','Carrinho vazio!');
    }
}

"use client";

import BannerHome from "./components/home/banner";
import ClientesHome from "./components/home/clientes";
import FornecedoresHome from "./components/home/fornecedores";
import ProdutosHome from "./components/home/produtos";

export default function Home() {
  return (
    <>
      <div>
        <BannerHome />
        <ProdutosHome />
        <ClientesHome />
        <FornecedoresHome />
      </div>
    </>
  );
}

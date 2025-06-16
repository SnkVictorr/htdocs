"use client";

import { BannerHome } from "./components/home/banner";
import { ProdutosHome } from "./components/home/produtos";

export default function Home() {
  return (
    <>
      <div>
        <BannerHome />
        <ProdutosHome />
      </div>
    </>
  );
}

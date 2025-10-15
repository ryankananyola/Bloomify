import React from "react";
import { NavLink } from "react-router-dom";
import { Home, Package, ShoppingBag, LogOut } from "lucide-react";

export default function Sidebar() {
  const handleLogout = () => {
    fetch("/logout", {
      method: "POST",
      headers: { "X-CSRF-TOKEN": document
        .querySelector('meta[name="csrf-token"]')
        ?.getAttribute("content") },
    }).then(() => (window.location.href = "/login"));
  };

  const menu = [
    { name: "Dashboard", icon: <Home size={20} />, path: "/florist/dashboard" },
    { name: "Produk", icon: <Package size={20} />, path: "/florist/products" },
    { name: "Pesanan", icon: <ShoppingBag size={20} />, path: "/florist/orders" },
  ];

  return (
    <div className="w-64 bg-white border-r border-pink-100 flex flex-col shadow-sm">
      <div className="p-5 border-b border-pink-100">
        <h1 className="text-2xl font-bold text-pink-600 tracking-tight">
          🌸 Bloomify
        </h1>
        <p className="text-gray-400 text-sm mt-1">Portal Florist</p>
      </div>

      <nav className="flex-1 p-4 space-y-1">
        {menu.map((item) => (
          <a
            key={item.name}
            href={item.path}
            className="flex items-center gap-3 px-4 py-2 rounded-lg text-gray-700 hover:bg-pink-50 hover:text-pink-600 transition"
          >
            {item.icon}
            <span>{item.name}</span>
          </a>
        ))}
      </nav>

      <div className="p-4 border-t border-pink-100">
        <button
          onClick={handleLogout}
          className="flex items-center gap-2 w-full text-left px-4 py-2 rounded-lg text-gray-700 hover:bg-red-50 hover:text-red-600 transition"
        >
          <LogOut size={20} />
          <span>Keluar</span>
        </button>
      </div>
    </div>
  );
}

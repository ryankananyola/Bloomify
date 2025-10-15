import React from "react";
import { Bell, User } from "lucide-react";

export default function Navbar() {
  return (
    <header className="bg-white shadow-sm border-b border-pink-100 px-6 py-3 flex items-center justify-between">
      <h2 className="text-lg font-semibold text-pink-600">Dashboard Florist</h2>

      <div className="flex items-center gap-4">
        <button className="relative hover:text-pink-500 transition">
          <Bell size={20} />
          <span className="absolute top-0 right-0 bg-pink-500 text-white text-[10px] rounded-full w-4 h-4 flex items-center justify-center">
            3
          </span>
        </button>

        <div className="flex items-center gap-2">
          <div className="w-8 h-8 rounded-full bg-pink-200 flex items-center justify-center">
            <User size={18} className="text-pink-600" />
          </div>
          <span className="text-gray-700 font-medium">Florist</span>
        </div>
      </div>
    </header>
  );
}

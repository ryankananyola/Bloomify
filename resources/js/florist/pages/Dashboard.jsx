import React, { useEffect, useState } from "react";
import Sidebar from "../components/Sidebar";
import Navbar from "../components/Navbar";
import axios from "axios";
import { motion } from "framer-motion";
import { Package, ShoppingBag, DollarSign } from "lucide-react";

export default function Dashboard() {
  const [stats, setStats] = useState(null);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    axios
      .get("/api/florist/stats")
      .then((res) => setStats(res.data))
      .catch((err) => console.error("Gagal memuat data florist:", err))
      .finally(() => setLoading(false));
  }, []);

  if (loading) {
    return (
      <div className="flex items-center justify-center min-h-screen text-gray-500">
        Memuat data...
      </div>
    );
  }

  if (!stats) {
    return (
      <div className="flex items-center justify-center min-h-screen text-red-500">
        Gagal memuat statistik florist.
      </div>
    );
  }

  const cards = [
    {
      title: "Total Produk",
      value: stats.products,
      icon: <Package className="w-8 h-8 text-pink-500" />,
    },
    {
      title: "Pendapatan",
      value: `Rp ${Number(stats.revenue).toLocaleString("id-ID")}`,
      icon: <DollarSign className="w-8 h-8 text-green-500" />,
    },
    {
      title: "Pesanan Terbaru",
      value: stats.orders.length,
      icon: <ShoppingBag className="w-8 h-8 text-purple-500" />,
    },
  ];

  return (
    <div className="flex min-h-screen bg-pink-50">
      <Sidebar />

      <div className="flex-1">
        <Navbar />

        <main className="p-6 space-y-6">
          <motion.h1
            className="text-3xl font-bold text-pink-600"
            initial={{ y: -10, opacity: 0 }}
            animate={{ y: 0, opacity: 1 }}
          >
            Dashboard Florist 🌸
          </motion.h1>
          <p className="text-gray-700">
            Selamat datang di portal pengelolaan florist Anda!
          </p>

          {/* Statistik Cards */}
          <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
            {cards.map((card, i) => (
              <motion.div
                key={i}
                className="bg-white p-6 rounded-2xl shadow flex items-center gap-4 hover:shadow-lg transition"
                initial={{ opacity: 0, y: 30 }}
                animate={{ opacity: 1, y: 0 }}
                transition={{ delay: i * 0.15 }}
              >
                <div className="p-3 bg-pink-100 rounded-full">{card.icon}</div>
                <div>
                  <h2 className="text-gray-600 font-medium">{card.title}</h2>
                  <p className="text-2xl font-bold text-gray-800 mt-1">
                    {card.value}
                  </p>
                </div>
              </motion.div>
            ))}
          </div>

          {/* Pesanan Terbaru */}
          <motion.div
            className="bg-white p-6 rounded-2xl shadow"
            initial={{ opacity: 0, y: 20 }}
            animate={{ opacity: 1, y: 0 }}
          >
            <h3 className="text-xl font-semibold text-gray-800 mb-4 flex items-center gap-2">
              <ShoppingBag className="w-5 h-5 text-pink-500" />
              Pesanan Terbaru
            </h3>

            {stats.orders.length > 0 ? (
              <ul className="divide-y divide-gray-100">
                {stats.orders.map((o) => (
                  <motion.li
                    key={o.id}
                    className="py-3 flex justify-between items-center hover:bg-pink-50 rounded-lg px-2"
                    whileHover={{ scale: 1.01 }}
                  >
                    <span className="font-medium text-gray-700">
                      {o.customer_name}
                    </span>
                    <span className="text-pink-600 font-semibold">
                      Rp {Number(o.total_price).toLocaleString("id-ID")}
                    </span>
                  </motion.li>
                ))}
              </ul>
            ) : (
              <p className="text-gray-500 text-center">
                Belum ada pesanan terbaru.
              </p>
            )}
          </motion.div>
        </main>
      </div>
    </div>
  );
}

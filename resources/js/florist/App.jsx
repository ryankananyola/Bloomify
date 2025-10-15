import React from 'react'
import ReactDOM from 'react-dom/client'

function App() {
  return <h1 style={{ textAlign: 'center', marginTop: '50px' }}>🌸 Dashboard Florist React Berhasil Dimuat!</h1>
}

ReactDOM.createRoot(document.getElementById('florist-dashboard')).render(
  <React.StrictMode>
    <App />
  </React.StrictMode>
)

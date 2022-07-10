import React from 'react';
import { Routes, Route, BrowserRouter } from 'react-router-dom';

import './App.css';
import Home from './pages/Home';
import CreateClient from './pages/CreateClient';

function App() {
  return (
    
    <BrowserRouter>
      <Routes>
        <Route path='/' element={<Home/>} />
        <Route path='/create/:id' element={<CreateClient/>} />
      </Routes>
    </BrowserRouter>
);
}

export default App;

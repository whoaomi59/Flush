import { BrowserRouter as Router, Routes, Route } from "react-router-dom";
import Galeria from "./view/galeria";
import Multimedia from "./view/Multimedia";
import axios from "axios";

function App() {
  //axios.defaults.baseURL = " http://localhost/Apps_Domicilios/API/";
  axios.defaults.baseURL = "https://asuprocolombiasas.com/php/API/";

  return (
    <Router>
      <Routes>
        <Route path="/" element={<Galeria />} />
        <Route path="/Multimedia/:id" element={<Multimedia />} />
        <Route path="*" element={"no fount"} />
      </Routes>
    </Router>
  );
}

export default App;

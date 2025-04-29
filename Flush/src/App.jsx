import { BrowserRouter as Router, Routes, Route } from "react-router-dom";
import Galeria from "./view/galeria";
import Multimedia from "./view/Multimedia";

function App() {
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

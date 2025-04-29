import { useEffect, useState } from "react";
import axios from "axios";

export default function Galeria() {
  const [data, setData] = useState([]);
  const [loader, setloader] = useState(false);
  useEffect(() => {
    const GetDatos = async () => {
      try {
        setloader(true);
        let response = await axios.get("/controller/datos/controller.php");
        setData(response.data);
        setloader(false);
      } catch (error) {
        console.log(error);
        setloader(false);
      }
    };
    GetDatos();
  }, []);

  if (loader) {
    return "cargand....";
  }

  return (
    <section class="py-24">
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <h2 class="font-manrope font-bold text-4xl text-black mb-8 max-xl:text-center">
          Galeria
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-8">
          {data.map((item) => (
            <a
              href={`/Multimedia/${item.id}`}
              class="relative bg-cover group rounded-3xl bg-center overflow-hidden mx-auto sm:mr-0 xl:mx-auto cursor-pointer"
            >
              <img
                class="rounded-2xl object-cover"
                src={item.multimedia}
                alt="Jacket image"
              />
              <div class="absolute z-10 bottom-3 left-0 mx-3 p-3 bg-white w-[calc(100%-24px)] rounded-xl shadow-sm shadow-transparent transition-all duration-500 group-hover:shadow-indigo-200 group-hover:bg-indigo-50">
                <div class="flex items-center justify-between mb-2">
                  <h6 class="font-semibold text-base leading-7 text-black ">
                    {item.nombre}
                  </h6>
                  <h6 class="font-semibold text-base leading-7 text-indigo-600 text-right">
                    {item.Tipo}
                  </h6>
                </div>
                <p class="text-xs leading-5 text-gray-500">{item.contacto}</p>
              </div>
            </a>
          ))}
        </div>
      </div>
    </section>
  );
}

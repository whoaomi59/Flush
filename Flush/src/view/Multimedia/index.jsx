import { useEffect, useState } from "react";
import axios from "axios";
import { useParams } from "react-router-dom";

export default function Multimedia() {
  const [data, setData] = useState([]);
  const [loader, setloader] = useState(false);
  const { id } = useParams();

  useEffect(() => {
    const GetDatos = async () => {
      try {
        setloader(true);
        let response = await axios.get(
          `/controller/Multimedia/controller.php?id=${id}`
        );
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
          Multimedia
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-8">
          {data.map((item) => (
            <a class="relative bg-cover group rounded-3xl bg-center overflow-hidden mx-auto sm:mr-0 xl:mx-auto cursor-pointer">
              <img
                class="rounded-2xl object-cover"
                src={item.multimedia}
                alt="Jacket image"
              />
            </a>
          ))}
        </div>
      </div>
    </section>
  );
}

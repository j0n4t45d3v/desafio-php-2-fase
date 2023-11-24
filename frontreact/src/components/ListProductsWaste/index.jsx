import { useEffect, useState } from "react";
import { api } from "../../service/api";
import { Line, Table } from "./style";

export function ListProductsWaste() {
    const [listProducts, setListProducts] = useState([]);

    useEffect(() => {
        const idWaste = localStorage.getItem("id_waste");
        api.get("product_prodution_wastes/id/" + idWaste)
            .then(res => res.data)
            .then(data => {
                setListProducts(data);
            });
    }, [listProducts]);

    return (
        <>
            <Table>
                <tr>
                    <Line>ID DESPERDICIO PRODUTO</Line>
                    <Line>DESCRIÇÂO</Line>
                    <Line>QUANTIDADE DESPERDIÇADA</Line>
                </tr>
                {listProducts.map((e, index) => (
                    <tr>
                        <Line key={index + e.id_desperdicio_produto}>{e.id_desperdicio_produto}</Line>
                        <Line key={index + e.id_desperdicio_produto + 1}>{e.descricao}</Line>
                        <Line key={index + e.id_desperdicio_produto + 2}> {e.qtde_saida}</Line>
                    </tr>
                ))}

            </Table>

        </>
    );
}
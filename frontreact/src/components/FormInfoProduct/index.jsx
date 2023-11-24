import { useEffect, useState } from "react";
import { ContainerForm, Input, Select } from "./style";
import { api } from "../../service/api";

export function FormInfoProduct({
    productState,
    quantityState,
    adding,
    
}) {
    const [products, setProducts] = useState([]);

    useEffect(() => {
        api.get("products")
            .then(res => res.data)
            .then(data => {
                console.log(data);
                setProducts(data);
            });

    }, [adding, setProducts]);

    return (
        <ContainerForm>
            <Select 
                onChange={e => productState(e.target.value)}
                >
                <option>selecione um produto</option>
                {products.map((e, index) => (
                    <option key={index} value={e.codigo_produto}>{e.descricao}</option>
                ))}
            </Select>

            <Input 
                onChange={e => quantityState(e.target.value)} 
                type="number" 
                placeholder="qtde saida" 
                />
        </ContainerForm>
    );
}
import { useEffect, useState } from "react";
import { ContainerModal, MainContainerModal, Th } from "./style";
import { api } from "../../service/api";

export function ModalWastes({ statusModal }) {
    const [wastes, setWastes] = useState([]);

    useEffect(() => {
        api.get("prodution_wastes")
            .then(res => res.data)
            .then(data => {
                setWastes(data);
                console.log(data);
            })
    }, [setWastes]);

    function closeModal() {
        statusModal(false)
    }

    return (
        <MainContainerModal onClick={closeModal}>
            <ContainerModal>
                <tr>
                    <Th>ID</Th>
                    <Th>PESSOA</Th>
                    <Th>DATA</Th>
                    <Th>PRODUÇÃO</Th>
                    <Th>STATUS</Th>
                </tr>

                {wastes.map(e => (
                    <tr>
                        <Th>{e.id}</Th>
                        <Th>{e.nome_pessoa}</Th>
                        <Th>{e.data_saida}</Th>
                        <Th>{e.numero_producao}</Th>
                        <Th>{e.finalizada}</Th>                        
                    </tr>
                ))}

            </ContainerModal>
        </MainContainerModal>
    );
}
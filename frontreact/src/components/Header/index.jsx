import { useState } from "react";
import { api } from "../../service/api";
import { Button } from "../Button/style";
import { ContainerHeader } from "./style";

export function Header({ findWastes, newWaste, savedWaste, cancel, edit, clean }) {
    const [isEdit, setIsEdit] = useState(false);

    function handlerFind() {
        findWastes(true);
    }

    function handlerNewWaste() {
        localStorage.clear();
        clean();
        newWaste();
    }

    function handlerSavedWaste() {
        savedWaste(isEdit);
    }

    function handlerEditWaste() {
        const getIdWaste = Number(prompt("Digite o id do desperdicio de produção: "));
        localStorage.setItem("id_waste", getIdWaste);
        edit()
        setIsEdit(true);
    }

    function handlerExclude(){
        const id = Number(prompt('Digite o id do desperdicio que deseja remover: '));
        api.delete("prodution_wastes/id/"+id)
            .then(res => alert('Desperdicio Removido com sucesso!'))
            .catch(error => alert(error.response.data.error));
    }

    return (
        <ContainerHeader>
            <Button onClick={handlerNewWaste}>Novo</Button>
            <Button onClick={handlerSavedWaste}>Salvar</Button>
            <Button onClick={handlerEditWaste}>Editar</Button>
            <Button onClick={e => cancel()}>Cancelar</Button>
            <Button onClick={handlerFind}>Pesquisar</Button>
            <Button onClick={handlerExclude}>Excluir</Button>
        </ContainerHeader>
    )
}
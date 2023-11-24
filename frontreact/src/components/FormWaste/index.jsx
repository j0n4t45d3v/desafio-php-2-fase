import { ContainerForm } from "./style";

export function FormWaste({ 
    personName,
    produtionNumber,
    date,
    personNameDefault,
    produtionNumberDefault,
    dateDefault 
}) {
    return (
        <ContainerForm> 
            <input 
                onChange={e => personName(e.target.value)}
                type="text" 
                placeholder="nome pessoa"
                defaultValue={personNameDefault}
            />
            <input
                onChange={e => produtionNumber(e.target.value)}
                type="text" 
                placeholder="numero producao" 
                defaultValue={produtionNumberDefault}
            />
            <input 
                onChange={e => date(e.target.value)} 
                type="date" 
                defaultValue={dateDefault}
            />
        </ContainerForm>
    );
}
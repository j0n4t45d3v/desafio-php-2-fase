import { useRef, useState } from 'react'
import { Header } from './components/Header'
import { FormWaste } from './components/FormWaste'
import { FormInfoProduct } from './components/FormInfoProduct'
import { ContainerProductWaste } from './globalStyle/ContainerProductWaste'
import { MainContainer } from './globalStyle/MainContainer'
import { ContainerForm } from './globalStyle/ContainerForm'
import { Button } from './components/Button/style'
import { ContainerButtons } from './globalStyle/ContainerButtons'
import { ModalWastes } from './components/ModalWastes'
import { api, url } from './service/api'
import { ListProductsWaste } from './components/ListProductsWaste'

function App() {
  const [newProdutionWaste, setNewProdutionWaste] = useState(false);
  const [saved, setSaved] = useState(false);
  const [modal, setModal] = useState(false);
  const [adding, SetAdding] = useState(false);

  const [personName, setPersonName] = useState('');
  const [produtionNumber, setProdutionNumber] = useState('');
  const [date, setDate] = useState('');

  const [product, setProduct] = useState();
  const [quantity, setQuantity] = useState();

  function handlerNewWaste() {
    cleanWasteProdution
    setNewProdutionWaste(true);
  }

  function handlerSaveWaste(isEdit) {

    const data = {
      "nome_pessoa": personName,
      "numero_producao": produtionNumber,
      "date": date
    }

    if (isEdit) {
      const idWaste = localStorage.getItem("id_waste");
      api.put("prodution_wastes/id/" + idWaste, data);
      return;
    }

    if(personName == '' || produtionNumber == '' || date == ''){
      alert('Os campos nome pessoa, numero produção e de data são obrigatorios');
      return;
    }

    api.post("prodution_wastes", data)
      .then(data => {
        api.get("prodution_wastes")
          .then(res => res.data)
          .then(data => {
            const value = data[data.length - 1];
            localStorage.setItem("id_waste", value.id);
          });
      }).catch(error => alert(error.response.error));


    setSaved(true);
  }

  function handlerCancel() {
    setNewProdutionWaste(false);
    setSaved(false)
    cleanWasteProdution()
    console.log(saved);
  }

  function handlerEdit() {
    setSaved(false);
    const idWaste = localStorage.getItem("id_waste");
    api.get("prodution_wastes/id/" + idWaste)
      .then(res => res.data)
      .then(data => {
        console.log(data.finalizada);
        if (data.finalizada == "S") {
          alert("Esse deperdicio de produtos já foi finalizado");
          cleanWasteProdution();

          localStorage.clear();
          return;
        }
        handlerNewWaste()
        setDate(data.data_saida);
        setPersonName(data.nome_pessoa);
        setProdutionNumber(data.numero_producao)
      })
      .catch(error => console.log(error))
    setSaved(true);
  }

  function cleanWasteProdution() {
    setDate('');
    setPersonName('');
    setProdutionNumber('');
    setNewProdutionWaste(false);
    setSaved(false);
  }

  function handlerAddProduct() {
    const codigo_produto = product;
    const qtde_saida = quantity;

    const productWaste = {
      codigo_produto,
      qtde_saida,
    }

    
    const idWaste = localStorage.getItem("id_waste");

    api.post("product_prodution_wastes/id/" + idWaste, productWaste)
      .then(res => res.data)
      .then(data => {
        alert("desperdicio do produto foi adicionado")
        SetAdding(true);

      });
    SetAdding(false);
  }

  function handlerReport() {
    const getIdWasteCurrent = localStorage.getItem("id_waste");
    window.open(url + "prodution_wastes/report/" + getIdWasteCurrent, "_blanck");
  }

  function handlerFinalize() {
    const idWaste = localStorage.getItem("id_waste");
    api.put("prodution_wastes/finalize/" + idWaste)
    cleanWasteProdution()
  }

  function handlerExcludeProductWaste() {
    const idProductWaste = Number(prompt('Digite o numero do id do produto desperdiçado: '));
    api.delete("product_prodution_wastes/id/" + idProductWaste)
      .then(res => {
        alert("desperdicio do produto removido")
        console.log(res);
      })
      .catch(error => alert(error.response.data));
  }

  function handlerEditProductWaste(){
    const idProductWaste = Number(prompt('Digite o numero do id do produto desperdiçado q desseja mudar: '));
    
    const idWaste = Number(localStorage.getItem("id_waste"));

    const dataProduct = {
      "id_waste": idWaste,
      "codigo_produto": product,
      "qtde_saida": quantity
    }

    api.get("product_prodution_wastes/product/"+idProductWaste)
      .then(res => {
        api.put("product_prodution_wastes/id/"+idProductWaste, dataProduct)
          .then(res => {
            console.log(res.data);
            alert("produto atualizado")
          })
          .catch(error => alert(error.response.data.error))
      })
      .catch(error => alert(error.response.error));
  }

  return (
    <MainContainer>
      <Header
        findWastes={setModal}
        newWaste={handlerNewWaste}
        savedWaste={handlerSaveWaste}
        cancel={handlerCancel}
        edit={handlerEdit}
        clean={cleanWasteProdution}
      />
      {newProdutionWaste ?
        <>
          <FormWaste
            personName={setPersonName}
            produtionNumber={setProdutionNumber}
            date={setDate}
            personNameDefault={personName}
            produtionNumberDefault={produtionNumber}
            dateDefault={date}
          />

          {saved ?
            <>
              <ContainerProductWaste>
                <ContainerForm>
                  <FormInfoProduct
                    productState={setProduct}
                    productDefault={product}
                    quantityState={setQuantity}
                    quantityDefault={quantity}
                    adding={adding}
                  />
                  <ListProductsWaste />
                </ContainerForm>
                <ContainerButtons>
                  <Button onClick={handlerFinalize}>Finalizar</Button>
                  <Button onClick={handlerReport}>Relatorio</Button>
                  <Button onClick={handlerAddProduct}>Adicionar Produto</Button>
                  <Button onClick={handlerEditProductWaste}>Editar Produto</Button>
                  <Button onClick={handlerExcludeProductWaste}>Excluir Produto</Button>
                </ContainerButtons>
              </ContainerProductWaste>
            </>
            : <p>Click em Salvar para ter acesso a proxima parte do formulario</p>
          }
        </>
        : <p>Click em novo para desbloquear o formulario</p>}

      {modal ? <ModalWastes statusModal={setModal} /> : null}
    </MainContainer>
  )
}

export default App

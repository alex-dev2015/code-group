import { Link } from 'react-router-dom';
import React, { ChangeEvent, FormEvent, useCallback, useEffect, useState } from "react";

import './styles.css';
import api from "../../services/api";

interface ListClients {
    id: number;
    name: string;
    cpf: string;
    mail: string;
    phone: string;
    address: string;
}

interface PageList {
    active: string;
    label: string;
    url: string;
}

const Home = () => {

    const [clients, setClients] = useState<ListClients[]>([]);
    const [pages, setPages] = useState<PageList[]>([]);
    const [page, setPage] = useState(String);
    const [currentPage, setCurrentPage] = useState(String);
    const [searchCpf, setSearchCpf] = useState(String);

    useEffect(() => {
        api.get(`clients?page=${page}`).then(response => {
            let pagination = response.data.links;
            pagination.shift();
            pagination.pop();

            setClients(response.data.data)
            setPages(pagination);
            setCurrentPage(response.data.current_page)
        })

    }, [page, searchCpf]);


    function handleSelectedPage(page: string) {
        setPage(page)
    }

    function handleInputChange(event: ChangeEvent<HTMLInputElement>) {
        let { value } = event.target;
        if (value !== '' && value.trim()) {
            setSearchCpf(value);
        }
    }

    function handleSearch(event: FormEvent) {
        event.preventDefault();
        api.get(`clients/search/${searchCpf}`)
            .then((response) => {
                if (response.data.length == 0) {
                    alert('Cliente não encontrado')
                    setSearchCpf('');

                } else {
                    setClients(response.data);
                    setPages([{ active: 'false', label: '1', url: '' }]);
                }

            })
            .catch((result) => {
                alert("Erro ao realizar busca: \n" + result.message)

            })
    }

    return (
        <>
        <h1>Página Inicial</h1>
            <div className="container">
            
                <header>
                    
                    <Link className='btn btn-info' to="/create/novo">
                        <strong>Cadastro de Cliente</strong>
                    </Link>
                    <form onSubmit={handleSearch}>
                    <input
                        id="search"
                        name="search"
                        type="text"
                        value={searchCpf}
                        onChange={handleInputChange}
                        placeholder="Pesquisar CPF..."
                        maxLength={11}
                    />
                    <button hidden type="submit" >Pesquisar</button>
                </form>

                </header>


                
                <div className='container-table'>
                    <table className="styled-table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nome</th>
                                <th>CPF</th>
                                <th>Email</th>
                                <th>Telefone</th>
                                <th>Endereço</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            {clients.map(item => (
                                <tr>
                                    <td key={item.id}>{item.id}</td>
                                    <td>{item.name}</td>
                                    <td>{item.cpf}</td>
                                    <td>{item.mail}</td>
                                    <td>{item.phone}</td>
                                    <td>{item.address}</td>
                                    <td>
                                        <Link
                                            className='btn btn-danger'
                                            to={`/create/${item.id}`}>Editar
                                        </Link>
                                    </td>
                                </tr>
                            ))}
                        </tbody>
                    </table>
                </div>
                <div className="pagination">
                    {pages.map(page => (
                        <button
                            id="buttonPage"
                            onClick={() => handleSelectedPage(page.label)}
                            disabled={
                                currentPage == page.label ? true : false
                            }
                        >
                            {page.label}
                        </button>
                    ))}
                </div>
            </div>
        </>
    )
}

export default Home;

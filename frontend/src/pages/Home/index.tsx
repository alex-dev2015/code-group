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
            <div className="container">
                <h1>Page Home</h1>

                <Link to="/create/novo">
                    <strong>Cadastro de Cliente</strong>
                </Link>

                <form onSubmit={handleSearch}>
                    <label>
                        Pesquisar
                    </label>
                    <input
                        id="search"
                        name="search"
                        type="text"
                        value={searchCpf}
                        onChange={handleInputChange}
                    />
                    <button type="submit" >Pesquisar</button>
                </form>

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
                                    <button>
                                        <Link to={`/create/${item.id}`}>Editar</Link>
                                    </button>
                                </td>
                            </tr>
                        ))}
                    </tbody>
                </table>
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
        </>
    )
}

export default Home;

import { Link, useNavigate, useParams } from "react-router-dom";
import React, { ChangeEvent, FormEvent, useEffect, useState } from "react";

import './styles.css';
import api from "../../services/api";

const CreateClient = () => {

    const { id = 'novo' } = useParams<'id'>();
    const navigate = useNavigate();

    const [formData, setFormData] = useState({
        name: '',
        cpf: '',
        mail: '',
        phone: '',
        address: '',
    });

    useEffect(() => {
        if (id !== 'novo') {
            api.get(`clients/${id}`)
                .then((result) => {
                    setFormData(result.data)
                })
                .catch((err) => {
                    console.error(err.response.data);
                    alert('Erro ao cadastrar o cliente: \n' + err.response.data.message)
                    navigate('/');
                })
        }
    }, [id])


    function handleInputChange(event: ChangeEvent<HTMLInputElement>) {
        const { name, value } = event.target;

        setFormData({ ...formData, [name]: value });
    }

    async function handleSubmit(event: FormEvent) {
        event.preventDefault();

        const { name, cpf, mail, phone, address } = formData;

        const data = {
            name,
            cpf,
            mail,
            phone,
            address
        }

        await api.post('clients', data)
            .then(() => {
                alert('Cliente cadastrado com sucesso!')
                navigate('/');
            })
            .catch((err) => {
                console.error(err.response.data);
                alert('Erro ao cadastrar o cliente: \n' + err.response.data.message)
            })

    }

    async function updateData() {
        await api.put(`clients/${id}`, formData)
            .then(() => {
                alert('Cliente atualizado com sucesso!')
                navigate('/');
            })
            .catch((err) => {
                console.error(err.response)
                alert('Erro ao atualizar o cliente: \n'
                    + err.response.data.message
                )
            })
    }

    return (
        <div id="page-create-client">
            <h1>
                {id === 'novo' ? 'Página de Cadastro' : `Editando o cliente ${id}`}
            </h1>
            <h2>
                <Link to={'/'}>Home</Link>
            </h2>
            <form onSubmit={handleSubmit} >
                <fieldset>
                    <div className="field">
                        <label htmlFor="name">Nome</label>
                        <input
                            type="text"
                            name="name"
                            id="name"
                            value={formData['name']}
                            onChange={handleInputChange}
                        />
                    </div>

                    <div className="field-group">
                        <div className="field">
                            <label htmlFor="cpf">Cpf</label>
                            <input
                                type="text"
                                name="cpf"
                                id="cpf"
                                maxLength={11}
                                value={formData['cpf']}
                                onChange={handleInputChange}
                            />
                        </div>

                        <div className="field">
                            <label htmlFor="phone">Telefone</label>
                            <input
                                type="tel"
                                name="phone"
                                id="phone"
                                minLength={10}
                                pattern="[0-9]{2}[0-9]{8,9}"
                                maxLength={11}
                                placeholder="DDD+Número"
                                value={formData['phone']}
                                onChange={handleInputChange}
                            />
                        </div>
                    </div>
                    <div className="field">
                        <label htmlFor="email">E-mail</label>
                        <input
                            type="email"
                            name="mail"
                            id="mail"
                            value={formData['mail']}
                            onChange={handleInputChange}
                        />
                    </div>

                    <div className="field">
                        <label htmlFor="address">Endereço</label>
                        <input
                            type="text"
                            name="address"
                            id="address"
                            onChange={handleInputChange}
                            value={formData['address']}
                        />
                    </div>
                </fieldset>
                {id === 'novo'
                    ? <button type="submit">Cadastrar Cliente</button>
                    : <button
                        type="button"
                        onClick={() => updateData()}
                        style={{ backgroundColor: '#A70E0F', color: '#FFF' }}
                    >
                        Atualizar Cliente
                    </button>
                }
            </form>
        </div>
    )
}

export default CreateClient;

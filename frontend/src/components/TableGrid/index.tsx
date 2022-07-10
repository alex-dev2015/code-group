import React from "react";

const TableGrid = () => {
    return (
        <div className="App">
          <table>
            <tr>
              <th>Nome</th>
              <th>CPF</th>
              <th>Email</th>
              <th>Telefone</th>
              <th>Endereço</th>
              <th>Ações</th>
            </tr>
            <tr>
              <td>Anom</td>
              <td>19</td>
              <td>Male</td>
              <td>98989898</td>
              <td>Rua pdo dsdd psd psd d</td>
              <td>
                <button>Editar</button>
              </td>
            </tr>
            <tr>
              <td>Megha</td>
              <td>19</td>
              <td>Female</td>
              <td>98989898</td>
              <td>Rua pdo dsdd psd psd d</td>
              <td>
                <button>Editar</button>
              </td>
            </tr>
            <tr>
              <td>Subham</td>
              <td>25</td>
              <td>Male</td>
              <td>98989898</td>
              <td>Rua pdo dsdd psd psd d</td>
              <td>
                <button>Editar</button>
              </td>
            </tr>
          </table>
        </div>
      );
}

export default TableGrid
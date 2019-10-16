{
    // Informacoes dos usuarios
    Usuario = [
        {
            'id': 1,
            'nome': 'oliver',
            'senha': '123456',
            'email': 'oliver@gmail.com',
            'telefone': '(31) 999999999',
            'cargo': 'Gerencia',
            'setor_id': 1
        },
        {
            'id': 2,
            'nome': 'admin',
            'senha': '123456',
            'email': 'administrador@gprotocol.com',
            'telefone': '(31) 8888888888',
            'cargo': 'Coordenador',
            'setor_id': 2
        }
    ],
    // Informacoes dos setores
    Setor = [
        {
            'id': 1,
            'nome': 'Setor 1',
            'unidade_id': 1
        },
        {
            'id': 2,
            'nome': 'Setor 2',
            'unidade_id': 2
        }
    ],
    // Informacoes das unidades
    Unidade = [
        {
            'id': 1,
            'nome': 'Unidade Santa Lucia'
        },
        {
            'id': 2,
            'nome': 'Unidade Joao Soares'
        }
    ],
    // Protocolos
    Protocolo = [
        {
            'id': 1,
            'titulo': 'Vacinas transporte',
            'dataCriacao': 1570661981, // timestamp
            'owner_id': 1,
            'owner_setor': 1,
            'descricao': 'Trasporte de vacinas para a unidade Joao Soares'
        },
        {
            'id': 2,
            'titulo': 'documentaçao',
            'dataCriacao': 1570661981, // timestamp
            'owner_id': 1,
            'owner_setor': 1,
            'descricao': 'rarararara'
        },
        {
            'id': 3,
            'titulo': 'nao',
            'dataCriacao': 1570661981, // timestamp
            'owner_id': 1,
            'owner_setor': 1,
            'descricao': 'Trasporte de vacinas para a unidade Joao Soares'
        }
    ],
    // Protocolos Encaminhandos / Rejeitados / Confirmados
    Encaminhamentos = [
        {
            'id': 1,
            'protocolo_id': 1,
            'remetente_id': 2,
            'destinatario_id': 1,
            'tipo': 'encaminhado',
            'data':  1570661981, // timestamp
        },
        {
            'id': 2,
            'protocolo_id': 2,
            'remetente_id': 2,
            'destinatario_id': 1,
            'tipo': 'encaminhado',
            'data':  1570661981, // timestamp
        },
        {
            'id': 3,
            'protocolo_id': 3,
            'remetente_id': 2,
            'destinatario_id': 1,
            'tipo': 'encaminhado',
            'data':  1570661981, // timestamp
        }
    ],
    // Anexos
    Anexo = [
        {
            'id': 1,
            'protocolo_id': 1,
            'usuario_owner': 1,
            'url': 'upload/[md5]'
        }
    ],
    // Comentarios
    Comentario = [
        {
            'id': 1,
            'protocolo_id': 1,
            'usuario_owner': 1,
            'comentario': 'Transporte adiado para o dia: 18/10/2019'
        }
    ]
}
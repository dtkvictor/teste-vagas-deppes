export default class Messages 
{
    private static messages:Record<string, any> = {
        success: {
            user: {
                registered: 'Usuário registrado com sucesso.',
                updated: 'Informações do perfil atualizadas com sucesso.',
                password_updated: 'Senha atualiza com sucesso.',
                deleted: 'Conta deletada com sucesso.'
            },            
            book: { 
                created: 'Seu livro foi adiciona com sucesso.',
                updated: 'Informações do seu livro foram atualizadas com sucesso.',
                deleted: 'Livro deletado com sucesso.',
            }
        },        
        error: {
            credentials: {
                invalid: 'Parece que as credenciais fornecidas não são válidas. Por favor, verifique suas informações e tente novamente.'
            },
            name: {
                required: 'O campo nome é obrigatorio',
                min: 'O nome deve ter no mínimo 3 caracteres',
                max: 'O nome deve ter no mínimo 255 caracteres',
            },
            email: {                
                invalid: 'Insira um email valido',
                max: 'O email não pode ter mais do que 255 caracteres',     
                required: 'O campo email é obrigatório.', 
                unique: 'Este email já está registrado.'                
            },
            thumb: {
                required: 'O campo Thumb é obrigatório',
                image: 'Por favor, escolha uma imagem válida.',
                max: 'A imagem deve ter no máximo 25mb.',
            },
            title: {
                required: 'O campo título é obrigatorio',
                min: 'O título deve ter no mínimo 3 caracteres',
                max: 'O título deve ter no mínimo 255 caracteres',
            },
            author: {
                required: 'O campo autor é obrigatorio',
                min: 'O autor deve ter no mínimo 3 caracteres',
                max: 'O autor deve ter no máximo 255 caracteres',
            },
            isbn: {
                required: 'O campo isbn é obrigatorio',
                min: 'O isbn deve ter no mínimo 10 caracteres',
                max: 'O isbn deve ter no máximo 20 caracteres',
            },
            description: {
                required: 'O campo descrição é obrigatório.',
                min: 'O campo descrição deve ter no mínimo 3 caracteres.',
                max: 'O campo descrição deve ter no máximo 500 caracteres.',
            },         
            number_pages: {
                required: 'O campo número de paginas é obrigatório.',   
                number: 'Informe um valor numérico.',
                min_digits: 'O seu livro precisa ter no mínimo 1 página',
                max_digits: 'O seu livro precisa ter no maximo 2000 páginas',            
            },
            category: {
                required: 'O campo categoria é obrigatório.',
                number: 'Escolha uma categoria válida.',
                exists: 'Escolha uma categoria válida.',
            },
            publisher: {
                required: 'O campo editora é obrigatório.',
                number: 'Escolha uma editora válida.',
                exists: 'Escolha uma editora válida.',
                min: 'O campo editora deve ter no mínimo 3 caracteres.',
                max: 'O campo editora deve ter no máximo 255 caracteres.'
            },
            validation: {
                uploaded: 'Tamanho limite do servidor.'
            },
            password: {
                min: 'A sua senha deve ter no mínimo 8 caracteres.',
                max: 'A sua senha deve ter no máximo 255 caracteres.',
                required: 'O campo senha é obrigatório.',
                confirmed: 'As senhas não coincidem.'
            },
            password_confirmation: {
                required: 'O campo confirmar senha é obrigatório',      
                confirmed: 'As senhas não coincidem.'          
            },           
            current_password: {
                required: 'Por favor, informe a sua senha atual.',
                invalid: 'Senha invalida.'
            }            
        }
    }

    protected static get(type:string, keyString: string): string|null
    {                         
        if(!keyString || keyString == '' || !this.messages) return null;
        
        const messages = this.messages[type];
        const [key, value] = keyString.replace(' ', '_').split('.');        

        if(messages[key] && messages[key][value]) {
            return messages[key][value];
        }                
        return null;
    }

    public static success(key: string): string
    {
        return this.get('success', key) ?? key;
    }

    public static error(key: string): string
    {
        return this.get('error', key) ?? key;
    }

    public static warning(key: string): string
    {
        return this.get('warning', key) ?? key;
    }

    public static info(key: string): string
    {
        return this.get('info', key) ?? key;
    }
}
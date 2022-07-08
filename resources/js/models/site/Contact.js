class Contact {
    static store(data, then, error) {
        axios.post('/api/contacts', data)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }

}

export default Contact;

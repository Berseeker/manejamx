class Like {
    static update(element, then, error) {
        axios.put('/api/vehicles/'+element+'/likes')
            .then(({data}) => then(data))
            .catch(({response}) => error(response));
    }
}

export default Like;

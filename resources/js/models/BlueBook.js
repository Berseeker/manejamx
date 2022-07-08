class BlueBook {
    static getPrice(element, then) {
        axios.get('/api/blue-book/versions/'+element)
            .then(({data}) => then(data));
    }

    
}

export default BlueBook;

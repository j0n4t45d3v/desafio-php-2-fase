import axios from "axios";

export const url = 'http://localhost/testphp/';

export const api = axios.create({
    baseURL: url
}) 
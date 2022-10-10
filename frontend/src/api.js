import Cookies from 'js-cookie';

import { config } from '@/config';

const withQueryParams = (url, queries) => {
    const keys = Object.keys(queries);
    if (keys.length === 0) {
        return url;
    }

    const queryParams = keys.map((key) => `${key}=${queries[key]}`).join('&');
    return `${url}?${queryParams}`;
};

const request = async (url, { queries = {}, ...config }) => {
    try {
        const response = await fetch(withQueryParams(url, queries), config);
        const json = await response.json();
        return json;
    } catch (err) {
        throw new Error(err.message);
    }
};

const transport = {
    post: (uri, { payload, queries } = {}) =>
        request(`${config.apiRoot}${uri}`, {
            method: 'POST',
            body: JSON.stringify(payload),
            queries,
            headers: {
                Authorization: `Bearer ${Cookies.get('token')}`,
                'Content-Type': 'application/json',
            },
        }),
    get: (uri, { queries } = {}) =>
        request(`${config.apiRoot}${uri}`, {
            method: 'GET',
            queries,
            headers: {
                Authorization: `Bearer ${Cookies.get('token')}`,
                'Content-Type': 'application/json',
            },
        }),
    put: (uri, { payload, queries } = {}) =>
        request(`${config.apiRoot}${uri}`, {
            method: 'PUT',
            body: JSON.stringify(payload),
            queries,
            headers: {
                Authorization: `Bearer ${Cookies.get('token')}`,
                'Content-Type': 'application/json',
            },
        }),
    delete: (uri, { queries } = {}) =>
        request(`${config.apiRoot}${uri}`, {
            method: 'GET',
            queries,
            headers: {
                Authorization: `Bearer ${Cookies.get('token')}`,
                'Content-Type': 'application/json',
            },
        }),
};

export const api = {
    login: (data) => transport.post('/api/get-token', data),
    getTasks: (data) => transport.get('/api/tasks', data),
    getArticles: () => transport.get('/blog/articles'),
    sendArticle: (data) => transport.post('/blog/articles', { payload: data }),
    getArticle: (data) => transport.get(`/blog/articles/${data}`),
    getReactions: (articleID, data) => transport.get(`/blog/user-reactions/${articleID}`, data),
};

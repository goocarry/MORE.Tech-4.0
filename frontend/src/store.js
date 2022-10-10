import {
    action,
    computed,
    makeObservable,
    observable,
    runInAction,
} from 'mobx';
import Cookies from 'js-cookie';

import { api } from '@/api';


class Store {
    @observable account = Cookies.get('token');
    @observable isLoadingAccount = false;

    @observable isLoadingTasks = false;
    @observable tasks = {
        once: [
            {
                id: 0,
                name: 'Регистрация',
                scores: 10,
            },
            {
                id: 1,
                name: 'Регистрация',
                scores: 10,
            },
        ],
        daily: [
            {
                id: 0,
                name: 'Регистрация',
                scores: 10,
            },
            {
                id: 1,
                name: 'Регистрация',
                scores: 10,
            },
        ],
        weekly: [
            {
                id: 0,
                name: 'Регистрация',
                scores: 10,
            },
            {
                id: 1,
                name: 'Регистрация',
                scores: 10,
            },
        ],
    };

    @observable products = [
        {
            id: 0,
            name: 'Кофе',
            price: 25,
        },
        {
            id: 1,
            name: 'Кофе',
            price: 25,
        },
        {
            id: 2,
            name: 'Кофе',
            price: 25,
        },
    ];
    @observable isLoadingProducts = false;

    @observable articles = [];
    @observable article = {};
    @observable isLoadingArticles = false;
    @observable isLoadingArticle = false;

    @observable reactions = {};
    @observable isLoadingReactions = false;

    constructor() {
        makeObservable(this);
    }

    @action login = async ({ username }) => {
        this.isLoadingAccount = true;
        try {
            const { token, user_id } = await api.login({ payload: { username } });

            runInAction(() => {
                Cookies.set('token', token);
                Cookies.set('user_id', user_id);
                this.isLoadingAccount = false;
                this.account = token;
            });
        } catch (err) {
            runInAction(() => {
                this.isLoadingAccount = false;
            });
            throw new Error(err.message);
        }
    }

    @action getTasks = async () => {
        this.isLoadingTasks = true;
        try {
            const response = await api.getTasks({
                queries: {
                    id: Cookies.get('token'),
                },
            });
            runInAction(() => {
                this.tasks = response;
            });
        } catch (err) {
            // skip
        } finally {
            runInAction(() => {
                this.isLoadingTasks = false;
            });
        }
    }

    @action getProducts = async () => {
        this.isLoadingProducts = true;
        try {
            const response = await api.getProducts();
            runInAction(() => {
                this.products = response;
            });
        } catch (err) {
            // skip
        } finally {
            runInAction(() => {
                this.isLoadingProducts = false;
            });
        }
    }

    getProduct = async (product) => {
        console.log(product);
    }

    @action getArticles = async () => {
        this.isLoadingArticles = true;
        try {
            const { items } = await api.getArticles();
            runInAction(() => {
                this.articles = items;
            });
        } catch (err) {
            // skip
        } finally {
            runInAction(() => {
                this.isLoadingArticles = false;
            });
        }
    }

    @action getArticle = async (id) => {
        this.isLoadingArticle = true;
        try {
            const article = await api.getArticle(id);
            runInAction(() => {
                this.article = article;
            });
        } catch (err) {
            // skip
        } finally {
            runInAction(() => {
                this.isLoadingArticle = false;
            });
        }
    }

    @action sendArticle = async (article) => {
        try {
            await api.sendArticle(article);
        } catch (err) {
            // skip
        }
    }

    @action getReactions = async (articleID) => {
        this.isLoadingReactions = true;
        try {
            const response = await api.getReactions(articleID);
            runInAction(() => {
                this.reactions = response;
            });
        } catch (err) {
            // skip
        } finally {
            runInAction(() => {
                this.isLoadingReactions = false;
            });
        }
    }

    @computed get isAuthorized() {
        return Boolean(this.account);
    }
}

export const configureStore = () => {
    const store = new Store();
    return { store };
};

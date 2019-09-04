import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        categories: [],
        items: [],
        feedback: '',
    },
    mutations: {
        SET_CATEGORIES(state, categories) {
            state.categories = categories;
        },
        ADD_CATEGORY(state, category) {
            state.categories.push(category);
        },
        REMOVE_CATEGORY(state, index) {
            state.categories.splice(index, 1);
        },
        UPDATE_CATEGORY(state, { index, property, value }) {
            state.categories[index][property] = value
        },
        SET_FEEDBACK(state, feedback) {
            state.feedback = feedback;
        }
    },
    actions: {
        saveCategories({ commit, state }) {
            axios.post('/api/categories/upsert', {
                categories: state.categories
            }).then(res => {
                if (res.data.success) {
                    commit('SET_FEEDBACK', 'Changes saved!');
                    setTimeout(() => commit('SET_FEEDBACK', ''), 2000);

                    commit('SET_CATEGORIES', res.data.categories);
                }
            });
        },
        removeCategory({ commit, state }, index) {
            const catId = state.categories[index].id;
                
            if (catId > 0) {
                return axios
                    .delete(`/api/categories/${catId}`)
                    .then(res => {
                        if (res.data.success) {
                            commit('REMOVE_CATEGORY', index);

                            commit('SET_FEEDBACK', 'Removed successfully!');
                            setTimeout(() => commit('SET_FEEDBACK', ''), 2000);
                        }
                    });
            }

            commit('REMOVE_CATEGORY', index);
        }
    }
})
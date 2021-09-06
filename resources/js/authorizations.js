/**
 *
 */
let user = window.Laravel.user;

module.exports = {
    master(model, prop = 'user_id') {
        return model[prop] === user.id;
    },

}

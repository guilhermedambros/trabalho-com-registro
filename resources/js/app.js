/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

window.Vue = require('vue');

// https://github.com/Pikaday/Pikaday
window.Pikaday = require('pikaday');

// https://github.com/jshjohnson/Choices
window.Choices = require('choices.js');

// https://github.com/vanilla-masker/vanilla-masker
window.VMasker = require('vanilla-masker');
console.log('teste')
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

if (document.querySelectorAll(".date_mask")) {
    VMasker(document.querySelectorAll(".date_mask")).maskPattern("99/99/9999");
}

function inputHandler(masks, max, event) {
    let c = event.target;
    let v = c.value.replace(/\D/g, '');
    let m = c.value.length > max ? 1 : 0;
    VMasker(c).unMask();
    VMasker(c).maskPattern(masks[m]);
    c.value = VMasker.toPattern(v, masks[m]);
}

let telMask = ['(99) 9999-99999', '(99) 99999-9999'];
let tel = document.querySelectorAll('.phone');
for (let el of tel) {
    VMasker(el).maskPattern(telMask[0]);
    el.addEventListener('input', inputHandler.bind(undefined, telMask, 14), false);
}

let docMask = ['999.999.999-999', '99.999.999/9999-99'];
let doc = document.querySelectorAll('.cpf');
let mask = 0;
for (let cpf of doc) {
    if (cpf.defaultValue.length == '' || cpf.defaultValue.length == 14) {
        mask = 1;
    }
    VMasker(cpf).maskPattern(docMask[mask]);
    cpf.addEventListener('input', inputHandler.bind(undefined, docMask, 14), false);
}

VMasker(document.querySelectorAll('.cep')).maskPattern('99999-999');

VMasker(document.querySelectorAll(".number")).maskNumber();

VMasker(document.querySelectorAll(".money")).maskMoney({
    precision: 2,
    separator: ',',
    delimiter: '.',
    unit: '',
    zeroCents: false
});

let i18n = {
    previousMonth : 'Mês Anterior',
    nextMonth     : 'Próximo Mês',
    months        : ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
    weekdays      : ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
    weekdaysShort : ['Dom','Seg','Ter','Qua','Qui','Sex','Sab']
}

var startDate,
    endDate,
    updateStartDate = function() {
        startPicker.setStartRange(startDate);
        endPicker.setStartRange(startDate);
        endPicker.setMinDate(startDate);
    },
    updateEndDate = function() {
        startPicker.setEndRange(endDate);
        startPicker.setMaxDate(endDate);
        endPicker.setEndRange(endDate);
    },
    startPicker = new Pikaday({
        field: document.getElementById('data_inicio'),
        format: 'D/M/YYYY',

        onSelect: function() {
            startDate = this.getDate();
            updateStartDate();
        },
        toString(date, format) {
            let day = date.getDate();
            let month = date.getMonth() + 1;
            let year = date.getFullYear();
            if (parseInt(day, 10) < 10) {
                day = 0 + day.toString();
            }
            if (parseInt(month, 10) < 10) {
                month = 0 + month.toString();
            }
            return `${day}/${month}/${year}`;
        },
        parse(dateString, format) {
            const parts = dateString.split('/');
            const day = parseInt(parts[0], 10);
            const month = parseInt(parts[1], 10) - 1;
            const year = parseInt(parts[2], 10);
            return new Date(year, month, day);
        },
        i18n: i18n
    }),
    endPicker = new Pikaday({
        field: document.getElementById('data_fim'),
        format: 'D/M/YYYY',
        minDate: startPicker,
        maxDate: new Date(2030, 12, 31),
        onSelect: function() {
            endDate = this.getDate();
            updateEndDate();
        },
        toString(date, format) {
            let day = date.getDate();
            let month = date.getMonth() + 1;
            let year = date.getFullYear();
            if (parseInt(day, 10) < 10) {
                day = 0 + day.toString();
            }
            if (parseInt(month, 10) < 10) {
                month = 0 + month.toString();
            }
            return `${day}/${month}/${year}`;
        },
        parse(dateString, format) {
            const parts = dateString.split('/');
            const day = parseInt(parts[0], 10);
            const month = parseInt(parts[1], 10) - 1;
            const year = parseInt(parts[2], 10);
            return new Date(year, month, day);
        },
        i18n: i18n
    }),
    _startDate = startPicker.getDate(),
    _endDate = endPicker.getDate();

    if (_startDate) {
        startDate = _startDate;
        updateStartDate();
    }
    if (_endDate) {
        endDate = _endDate;
        updateEndDate();
    }

var els = document.getElementsByClassName("datepicker");
Array.from(els).forEach((element) => {
    new Pikaday({
        field: element,
        format: 'D/M/YYYY',
        toString(date, format) {
            let day = date.getDate();
            let month = date.getMonth() + 1;
            let year = date.getFullYear();
            if (parseInt(day, 10) < 10) {
                day = 0 + day.toString();
            }
            if (parseInt(month, 10) < 10) {
                month = 0 + month.toString();
            }
            return `${day}/${month}/${year}`;
        },
        parse(dateString, format) {
            const parts = dateString.split('/');
            const day = parseInt(parts[0], 10);
            const month = parseInt(parts[1], 10) - 1;
            const year = parseInt(parts[2], 10);
            return new Date(year, month, day);
        },
        i18n: {
            previousMonth : 'Mês Anterior',
            nextMonth     : 'Próximo Mês',
            months        : ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
            weekdays      : ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
            weekdaysShort : ['Dom','Seg','Ter','Qua','Qui','Sex','Sab']
        }
    });
});

if (document.querySelector('#cep')) {
    document.querySelector('#cep').addEventListener('change', function() {
        let cep = document.getElementById('cep').value;
        cep = cep.replace(/[^a-zA-Z0-9]/g,'');
        fetch(`https://api.postmon.com.br/v1/cep/${cep}`, {
            method: 'GET',
        }).then(res => {
            res.body.getReader().read().then(r => {
                const result = new TextDecoder("utf-8").decode(r.value);
                const re = (JSON.parse(result));
                document.getElementById('endereco').value = re.logradouro;
                document.getElementById('bairro').value = re.bairro;
                document.getElementById('estado').value = re.estado;
            })
        });
    });
}

const choicesConfig = {
    noResultsText: 'Sem resultados encontrados',
    noChoicesText: 'Sem mais resultados',
    itemSelectText: 'Aperte para selecionar',
    loadingText: 'Carregando...',
    removeItemButton: false,
};


if (document.getElementById('pessoa_id')) {
    new Choices(document.getElementById('pessoa_id'), choicesConfig);
}
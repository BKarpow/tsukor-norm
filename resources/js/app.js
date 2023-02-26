/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import "./bootstrap";
// import Vue from "vue";
import { createApp } from "vue";
import VCalendar from "v-calendar";
import "v-calendar/dist/style.css";
// import "mdb-vue-ui-kit/css/mdb.min.css";

/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

/**
 * Enable popper
 */
window.enablePop = () => {
    console.log("Enable pop run");
    const popoverTriggerList = document.querySelectorAll(
        '[data-bs-toggle="popover"]'
    );
    const popoverList = [...popoverTriggerList].map(
        (popoverTriggerEl) => new bootstrap.Popover(popoverTriggerEl)
    );
};

const app = createApp({});
app.use(VCalendar, {});

import ExampleComponent from "./components/ExampleComponent.vue";
import CalcHO from "./components/CalcHO.vue";
import IGList from "./components/IGlist.vue";
import IconAdd from "./ui/icon/IconAdd.vue";
import SugarAddTriggers from "./components/SugarAddTriggers.vue";
import DateTimeField from "./components/DateTimeField.vue";
import DeleteBtn from "./components/DeleteBtn.vue";
import ChartGluLast7day from "./components/ChartGluLast7day.vue";
import ChartDugSugar from "./components/ChartDugSugar.vue";
import SugarTargetRange from "./components/SugarTargetRange.vue";
import BloodPressure from "./components/BloodPressure.vue";
import Spoler from "./components/Spoler.vue";
import GluItem from "./components/GluItem.vue";
import ToolsSugar from "./components/ToolsSugar.vue";
import MedicamentItem from "./components/MedicamentItem.vue";

app.component("ig-list", IGList);
app.component("example-component", ExampleComponent);
app.component("i-add", IconAdd);
app.component("calc-ho-inputs", CalcHO);
app.component("sugar-add-triggers", SugarAddTriggers);
app.component("date-time-field", DateTimeField);
app.component("delete-btn", DeleteBtn);
app.component("chart-7", ChartGluLast7day);
app.component("chart-dug", ChartDugSugar);
app.component("sugar-tr", SugarTargetRange);
app.component("bp-app", BloodPressure);
app.component("spoler", Spoler);
app.component("glu-item", GluItem);
app.component("tools-sugar", ToolsSugar);
app.component("med-item", MedicamentItem);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */

app.mount("#app");

import "./bootstrap";
import { createApp } from "vue";
import WorkflowsGrid from "./components/WorkflowsGrid";

const app = createApp({});
app.component("workflows-grid", WorkflowsGrid);
app.mount("#app");

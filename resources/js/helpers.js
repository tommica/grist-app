import format from "date-fns/format";
import parseISO from "date-fns/parseISO";

const zroute = window.route;

const formatDate = (date) => date ? format(parseISO(date), "yyyy-MM-dd") : null;

export {zroute, formatDate};
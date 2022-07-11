import { writable } from 'svelte/store';

const itemName = "user"
const retrieved = localStorage.getItem(itemName)
const parsed = JSON.parse(retrieved)
const PollStore = writable(parsed === null ? [] : parsed)

export default PollStore;


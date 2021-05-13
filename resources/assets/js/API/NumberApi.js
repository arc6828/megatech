import axios from "./axios";

const getAll = () => {
  return axios.get("/numberun");
};

const get = id => {
  return axios.get(`/numberun/${id}`);
};

const create = data => {
  return axios.post("/numberun/create", data);
};

const update = (id, data) => {
  return axios.put(`/numberun/${id}`, data);
};

// const remove = id => {
//   return axios.delete(`/tutorials/${id}`);
// };

// const removeAll = () => {
//   return axios.delete(`/tutorials`);
// };

// const findByTitle = title => {
//   return axios.get(`/tutorials?title=${title}`);
// };

export default {
  getAll,
  get,
  create,
  update,
  // remove,
  // removeAll,
  // findByTitle
};
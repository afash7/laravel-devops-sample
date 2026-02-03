import http from 'k6/http';
import { sleep, check } from 'k6';

export let options = {
  vus: 50,          // Virtual Users
  duration: '30s',  // Test duration
};

export default function () {

  // ===============================
  // Fetch API
  // ===============================
  let res = http.get('http://localhost/api/health');

  check(res, {
    'status is 200': (r) => r.status === 200,
  });

  sleep(1);
}

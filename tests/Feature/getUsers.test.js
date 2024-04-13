import {describe, expect, test} from 'vitest';
import axios from 'axios';

describe('test to get all users from table users', () => {
  test('should return all users', async () => {
    try{
        const response = await axios.get('/getAllUsers');
        expect(response.status).toBe(200);
        expect(response.headers['content-type']).toContain('application/json');
        expect(response.data.length).toBeGreaterThan(0);
    }

    catch(error){
        console.log(error);
    }
  });
});
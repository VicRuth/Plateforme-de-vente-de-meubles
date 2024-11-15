// family.model.ts
export class Family {
  constructor(public id: number, public name: string) {}
}

export interface FamilyApiResponse {
  id: number;
  name: string;
}

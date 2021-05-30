import { ReduxState, Record, Identifier } from 'react-admin';

export type ThemeName = 'light' | 'dark';

export interface AppState extends ReduxState {
    theme: ThemeName;
}

export interface Payment extends Record {
    date: Date;
    total: number;
}

export interface PetroPrice extends Record {
    date: Date;
    total: number;
}

export interface Liquidation extends Record {
    date: Date;
    total: number;
}

export interface License extends Record {
    date: Date;
    total: number;
}

export interface Taxpayer extends Record {
    date: Date;
    total: number;
}

import { ReduxState, Record, Identifier, ShowProps } from 'react-admin';

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
    name: string;
}

export interface EconomicActivity extends Record {
    name: string;
    min_tax: number;
    aliquote: number;
    code: string;
    active: boolean;
}

export interface Cancellation extends Record {
    cancellable?: any;
}

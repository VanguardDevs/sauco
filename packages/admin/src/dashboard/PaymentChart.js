import * as React from 'react';
import { Card, CardHeader, CardContent } from '@material-ui/core';
import {
    ResponsiveContainer,
    AreaChart,
    Area,
    XAxis,
    YAxis,
    CartesianGrid,
    Tooltip,
} from 'recharts';
import { format, subDays, addDays, parse } from 'date-fns';
import abbreviate from "number-abbreviate";

const lastDay = new Date();
const lastMonthDays = Array.from({ length: 30 }, (_, i) => subDays(lastDay, i));
const aMonthAgo = subDays(new Date(), 30);

const dateFormatter = date =>
    new Date(date).toLocaleDateString();

const aggregatePaymentsByDay = payments =>
    payments
        .reduce((acc, curr) => {
            const day = format(
                parse(curr.processed_at, 'dd/MM/yyyy H:m', new Date()),
                'yyyy-MM-dd'
            );

            if (!acc[day]) {
                acc[day] = 0;
            }
            acc[day] += curr.amount;

            return acc;
        }, []);

const getRevenuePerDay = payments => {
    const daysWithRevenue = aggregatePaymentsByDay(payments);
    return lastMonthDays.map(date => ({
        date: date.getTime(),
        amount: daysWithRevenue[format(date, 'yyyy-MM-dd')] || 0,
    }));
};

const PaymentChart = ({ payments }) => {
    if (!payments) return null;

    return (
        <Card>
            <CardHeader title={'Ingresos durante el último mes'} />
            <CardContent>
                <div style={{ width: '100%', height: 300 }}>
                    <ResponsiveContainer>
                        <AreaChart data={getRevenuePerDay(payments)}>
                            <defs>
                                <linearGradient
                                    id="colorUv"
                                    x1="0"
                                    y1="0"
                                    x2="0"
                                    y2="1"
                                >
                                    <stop
                                        offset="5%"
                                        stopColor="#8884d8"
                                        stopOpacity={0.8}
                                    />
                                    <stop
                                        offset="95%"
                                        stopColor="#8884d8"
                                        stopOpacity={0}
                                    />
                                </linearGradient>
                            </defs>
                            <XAxis
                                dataKey="date"
                                name="Date"
                                type="number"
                                scale="time"
                                domain={[
                                    addDays(aMonthAgo, 1).getTime(),
                                    new Date().getTime(),
                                ]}
                                tickFormatter={dateFormatter}
                            />
                            <YAxis
                                tickFormatter={abbreviate}
                                dataKey="amount"
                                name="Ingresos"
                                unit="VES"
                            />
                            <CartesianGrid strokeDasharray="3 3" />
                            <Tooltip
                                cursor={{ strokeDasharray: '3 3' }}
                                formatter={value =>
                                    new Intl.NumberFormat(undefined, {
                                        style: 'currency',
                                        currency: 'VES',
                                    }).format(value)
                                }
                                labelFormatter={dateFormatter}
                            />
                            <Area
                                type="monotone"
                                dataKey="amount"
                                stroke="#8884d8"
                                strokeWidth={2}
                                fill="url(#colorUv)"
                            />
                        </AreaChart>
                    </ResponsiveContainer>
                </div>
            </CardContent>
        </Card>
    );
};

export default PaymentChart;

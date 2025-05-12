export type CellFormat = 'TextColumn' | 'CheckboxColumn' | 'AvatarColumn' | 'ActionColumn';

export type DataItem = any;

export type ActionType = 'url' | 'modal';

export interface Action {
    label: string;
    action: string | (() => void);
    icon?: string;
    actionType: ActionType;
}

export interface DataTableColumn<TItem = DataItem, TValue = any> {
    accessorKey: keyof TItem & string;
    header: string;
    format: CellFormat;
    cell?: (value: TValue, item: TItem) => any;
    enableSorting?: boolean;
    enableHiding?: boolean;
    notVisibled?: boolean;
    actions?: string[];
}

export interface Link {
    first: string | null;
    last: string | null;
    prev: string | null;
    next: string | null;
}

export interface Meta {
    current_page: number;
    from: number | null;
    last_page: number;
    links: {
        active: boolean;
        label: string;
        url: string | null;
    }[];
    path: string;
    per_page: number;
    to: number | null;
    total: number;
}

export interface DataTableProps<TData> {
    columns: DataTableColumn<TData>[];
    response: {
        data: TData[];
        links: Link;
        meta: Meta;
    };
}

import {Duration, DurationObject} from 'luxon';
import {useTranslation} from 'react-i18next';

interface DiffProps {
    duration: Duration
}

export default function Diff(props: DiffProps) {
    const {t} = useTranslation('time');

    const parts = props.duration.normalize().shiftTo('years', 'months', 'weeks').toObject();
    parts.weeks = Math.floor(parts.weeks || 0);

    return (
        <>{t(durationType(parts), parts)}</>
    );
}

function durationType(duration: DurationObject): string {
    if (duration.years && duration.years > 0) {
        return 'durations.years';
    }

    if (duration.months && duration.months > 0) {
        return 'durations.months';
    }

    return 'durations.weeks';
}

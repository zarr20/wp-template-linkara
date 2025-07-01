import { Box, Container, Skeleton, Typography } from '@mui/material';
import Button from '../button';
import './index.scss';
import { ReactComponent as DownArrowIcon } from "assets/img/background/destination/codeshare/arrow-down-line.svg";
import { ReactComponent as QuestionIcon } from "assets/img/icon/question.svg";
import { useRef } from 'react';
import Image from "shared/utility/image";
import { mapUrl } from 'lib';

interface HeroComponentProps {
    data?: MainBannerInFlightProps | undefined;
}

export interface MainBannerInFlightProps {
    image?: any;
    title?: string;
    sub_title?: string;
    description?: string;
    button_text1?: string;
}

const HeroComponent: React.FC<HeroComponentProps> = ({ data }) => {
    const targetElementRef = useRef<HTMLDivElement | null>(null);

    const scrollToTarget = () => {
        if (targetElementRef.current) {
            targetElementRef.current.scrollIntoView({ behavior: "smooth", block: "start" });
        }
    };

    return (
        <Box className="hero">
            <Box className="hero__background">
                {!data && (
                    <Skeleton className="hero__skeleton" />
                )}
                {data?.image && (
                    <Image
                        src={data?.image?.renditions?.["1920x1080"].link}
                        sources="magnolia"
                        className="hero__image"
                    />
                )}
                <Box className="hero__overlay" />
            </Box>
            <Container className="hero__container">
                <Box className="hero__content">
                    <Box className="hero__text">
                        {!data ? (
                            <>
                                <Skeleton variant="text" height="40px" width="300px" />
                                <Skeleton variant="text" height="70px" width="700px" />
                                <Skeleton variant="text" height="30px" width="500px" />
                                <Skeleton variant="text" height="30px" width="500px" />
                                <Skeleton variant="text" height="30px" width="300px" />
                            </>
                        ) : (
                            <>
                                {data.title && <Typography variant="h1" className="hero__title">{data.title}</Typography>}
                                {data.sub_title && <Typography variant="h2" className="hero__subtitle">{data.sub_title}</Typography>}
                                {data.description && (
                                    <Typography
                                        className="hero__caption"
                                        variant="caption"
                                        component="div"
                                        dangerouslySetInnerHTML={{ __html: data.description }}
                                    />
                                )}
                            </>
                        )}
                    </Box>

                    {data?.button_text1 && (
                        <Box>
                            <Button
                                variant="outlined"
                                variantColor="secondary"
                                text={data.button_text1 ?? "Scroll Down"}
                                suffix="right"
                                icon={<DownArrowIcon />}
                                onClick={scrollToTarget}
                            />
                        </Box>
                    )}
                </Box>
                <Box sx={{ position: "absolute", bottom: "32px", right: "32px" }}>
                    <Button
                        variant="outlined"
                        variantColor="secondary"
                        text={"Contact Us"}
                        suffix="right"
                        className="contactus"
                        icon={<QuestionIcon />}
                        href={mapUrl("contact")}
                    />
                </Box>
            </Container>
            <Box ref={targetElementRef} className="hero__target" />
        </Box>
    );
};

export default HeroComponent;
